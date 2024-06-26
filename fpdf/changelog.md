# Changelog

**v1.86** (2023-06-25)
- Added a parameter to AddFont() to specify the directory where to load the font definition file.
- Fixed a bug related to the PDF creation date.

**v1.85** (2022-11-10)
- Removed deprecation notices on PHP 8.2.
- Removed notices when passing null values instead of strings.
- The `FPDF_VERSION` constant was replaced by a class constant.
- The creation date of the PDF now includes the timezone.
- The content-type is now always `application/pdf`, even for downloads.

**v1.84** (2021-08-28)
- Fixed an issue related to annotations.

**v1.83** (2021-04-18)
- Fixed an issue related to annotations.

**v1.82** (2019-12-07)
- Removed a deprecation notice on PHP 7.4.

**v1.81** (2015-12-20)
- Added `GetPageWidth()` and `GetPageHeight()`.
- Fixed a bug in `SetXY()`.

**v1.8** (2015-11-29)
- PHP 5.1.0 or higher is now required.
- The MakeFont utility now subsets fonts, which can greatly reduce font sizes.
- Added ToUnicode CMaps to improve text extraction.
- Added a parameter to AddPage() to rotate the page.
- Added a parameter to SetY() to indicate whether the x position should be reset or not.
- Added a parameter to Output() to specify the encoding of the name, and special characters are now properly encoded. Additionally, the order of the first two parameters was reversed to be more logical (however, the old order is still supported for compatibility).
- The `Error()` method now throws an exception.
- Adding contents before the first `AddPage()` or after `Close()` now raises an error.
- Outputting text with no font selected now raises an error.

**v1.7** (2011-06-18)
- The MakeFont utility has been completely rewritten and doesn't depend on ttf2pt1 anymore.
- Alpha channel is now supported for PNGs.
- When inserting an image, it's now possible to specify its resolution.
- Default resolution for images was increased from 72 to 96 dpi.
- When inserting a GIF image, no temporary file is used anymore if the PHP version is 5.1 or higher.
- When output buffering is enabled and the PDF is about to be sent, the buffer is now cleared if it contains only a UTF-8 BOM and/or whitespace (instead of throwing an error).
- Symbol and ZapfDingbats fonts now support underline style.
- Custom page sizes are now checked to ensure that width is smaller than height.
- Standard font files were changed to use the same format as user fonts.
- A bug in the embedding of Type1 fonts was fixed.
- A bug related to `SetDisplayMode()` and the current locale was fixed.
- A display issue occurring with the Adobe Reader X plug-in was fixed.
- An issue related to transparency with some versions of Adobe Reader was fixed.
- The `Content-Length` header was removed because it caused an issue when the HTTP server applies compression.

**v1.6** (2008-08-03)
- PHP 4.3.10 or higher is now required.
- GIF image support.
- Images can now trigger page breaks.
- Possibility to have different page formats in a single document.
- Document properties (author, creator, keywords, subject, and title) can now be specified in UTF-8.
- Fixed a bug: when a PNG was inserted through a URL, an error sometimes occurred.
- An automatic page break in `Header()` doesn't cause an infinite loop anymore.
- Removed some warning messages appearing with recent PHP versions.
- Added HTTP headers to reduce problems with IE.

**v1.53** (2004-12-31)
- When the font subdirectory is in the same directory as `fpdf.php`, it's no longer necessary to define the `FPDF_FONTPATH` constant.
- The array `$HTTP_SERVER_VARS` is no longer used. It could cause trouble on PHP5-based configurations with the `register_long_arrays` option disabled.
- Fixed a problem related to Type1 font embedding which caused trouble for some PDF processors.
- The file name sent to the browser could not contain a space character.
- The `Cell()` method could not print the number 0 (you had to pass the string '0').

**v1.52** (2003-12-30)
- `Image()` now displays the image at 72 dpi if no dimension is given.
- `Output()` takes a string as the second parameter to indicate destination.
- `Open()` is now called automatically by `AddPage()`.
- Inserting remote JPEG images doesn't generate an error any longer.
- Decimal separator is forced to dot in the constructor.
- Added several encodings (Turkish, Thai, Hebrew, Ukrainian, and Vietnamese).
- The last line of a right-aligned `MultiCell()` was not correctly aligned if it was terminated by a carriage return.
- No more error message about already sent headers when outputting the PDF to the standard output from the command line.
- The underlining was going too far for text containing characters `\`, `(`, or `)`.
- `$HTTP_ENV_VARS` has been replaced by `$HTTP_SERVER_VARS`.

**v1.51** (2002-08-03)
- Type1 font support.
- Added Baltic encoding.
- The class now works internally in points with the origin at the bottom to avoid two bugs occurring with Acrobat 5:
  * The line thickness was too large when printed on Windows 98 SE and ME.
  * TrueType fonts didn't appear immediately inside the plug-in (a substitution font was used), one had to cause a window refresh to make them show up.
- It's no longer necessary to set the decimal separator as dot to produce valid documents.
- The clickable area in a cell was always on the left independently from the text alignment.
- JPEG images in CMYK mode appeared in inverted colors.
- Transparent PNG images in grayscale or true-color mode were incorrectly handled.
- Adding new fonts now works correctly even with the `magic_quotes_runtime` option set to on.

**v1.5** (2002-05-28)
- TrueType font (`AddFont()`) and encoding support (Western and Eastern Europe, Cyrillic, and Greek).
- Added `Write()` method.
- Added underlined style.
- Internal and external link support (`AddLink()`, `SetLink()`, `Link()`).
- Added right margin management and methods `SetRightMargin()`, `SetTopMargin()`.
- Modification of `SetDisplayMode()` to select page layout.
- The border parameter of `MultiCell()` now lets choose borders to draw as `Cell()`.
- When a document contains no page, `Close()` now calls `AddPage()` instead of causing a fatal error.

**v1.41** (2002-03-13)
- Fixed `SetDisplayMode()` which no longer worked (the PDF viewer used its default display).

**v1.4** (2002-03-02)
- PHP3 is no longer supported.
- Page compression (`SetCompression()`).
- Choice of page format and the possibility to change orientation inside the document.
- Added `AcceptPageBreak()` method.
- Ability to print the total number of pages (`AliasNbPages()`).
- Choice of cell borders to draw.
- New mode for `Cell()`: the current position can now move under the cell.
- Ability to include an image by specifying height only (width is calculated automatically).
- Fixed a bug: when a justified line triggered a page break, the footer inherited the corresponding word spacing.

**v1.31** (2002-01-12)
- Fixed a bug in drawing the frame with `MultiCell()`: the last line always started from the left margin.
- Removed `Expires` HTTP header (causes trouble in some situations).
- Added `Content-disposition` HTTP header (seems to help in some situations).

**v1.3** (2001-12-03)
- Line break and text justification support (`MultiCell()`).
- Color support (`SetDrawColor()`, `SetFillColor()`, `SetTextColor()`). Possibility to draw filled rectangles and paint cell background.
- A cell whose width is declared null extends up to the right margin of the page.
- Line width is now retained from page to page and defaults to 0.2 mm.
- Added `SetXY()` method.
- Fixed a passing by reference done in a deprecated manner for PHP4.

**v1.2** (2001-11-11)
- Added font metric files and `GetStringWidth()` method.
- Centering and right-aligning text in cells.
- Display mode control (`SetDisplayMode()`).
- Added methods to set document properties (`SetAuthor()`, `SetCreator()`, `SetKeywords()`, `SetSubject()`, `SetTitle()`).
- Possibility to force PDF download by the browser.
- Added `SetX()` and `GetX()` methods.
- During automatic page break, the current abscissa is now retained.

**v1.11** (2001-10-20)
- PNG support doesn't require PHP4/zlib anymore. Data are now put directly into PDF without any decompression/recompression stage.
- Image insertion now works correctly even with the `magic_quotes_runtime` option set to on.

**v1.1** (2001-10-07)
- JPEG and PNG image support.

**v1.01** (2001-10-03)
- Fixed a bug involving page break: in case when `Header()` doesn't specify a font, the one from the previous page was not restored and produced an incorrect document.

**v1.0** (2001-09-17)
- First version.
