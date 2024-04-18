<?php
declare(strict_types=1);

namespace FPDF\Scripts\PDFMemImage;

// Stream handler to read from global variables
class VariableStream
{
    public $context;
    private string $varname;
    private int $position;

    public function stream_open(string $path, string $mode, int $options, ?string &$opened_path): bool
    {
        $url = parse_url($path);
        $this->varname = $url['host'] ?? '';
        if (!isset($GLOBALS[$this->varname])) {
            trigger_error('Global variable ' . $this->varname . ' does not exist', E_USER_WARNING);
            return false;
        }
        $this->position = 0;
        return true;
    }

    public function stream_read(int $count): string|false
    {
        $ret = substr($GLOBALS[$this->varname], $this->position, $count);
        $this->position += strlen($ret);
        return $ret;
    }

    public function stream_eof(): bool
    {
        return $this->position >= strlen($GLOBALS[$this->varname]);
    }

    public function stream_tell(): int
    {
        return $this->position;
    }

    public function stream_seek(int $offset, int $whence): bool
    {
        if ($whence != SEEK_SET) {
            return false;
        }

        $this->position = $offset;
        return true;
    }

    public function stream_stat(): array
    {
        return [];
    }
}