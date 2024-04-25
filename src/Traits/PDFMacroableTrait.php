<?php
declare(strict_types=1);

namespace Drsi\FPDF\Traits;


use BadMethodCallException;
use Closure;
/**
 * Docs: Lire le Readme correspondant
 */
trait PDFMacroableTrait
{
	/**
	 * The registered string macros.
	 *
	 * @var array
	 */
	protected static array $macros = [];

	/**
	 * Register a custom macro.
	 *
	 * @param  string  $name
	 * @param  callable | object  $macro
	 * @return void
	 */
	public static function macro(string $name, $macro)
	{
		static::$macros[$name] = $macro;
	}


	public static function hasMacro(string $name): bool
	{
		return isset(static::$macros[$name]);
	}

	/**
	 * Dynamically handle calls to the class.
	 *
	 * @param  string  $method
	 * @param  array  $parameters
	 * @return mixed
	 *
	 * @throws \BadMethodCallException
	 */
	public function __call($method, $parameters)
	{
		if (!array_key_exists($method, static::$macros)) {
			throw new BadMethodCallException(
				sprintf(
					'Method %s::%s does not exist.',
					static::class,
					$method
				)
			);
		}

		$macro = static::$macros[$method];

		if ($macro instanceof Closure) {
			$macro = $macro->bindTo($this, static::class);
		}

		return $macro(...$parameters);
	}
}
