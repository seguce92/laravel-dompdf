## DOMPDF Wrapper for Laravel 5.*

## Installation

### Laravel 5.x:
You can install the package for your Laravel 5 project through Composer.

```bash
$ composer require seguce92/laravel-dompdf
```

Register the service provider array in `app/config/app.php`.

    Seguce92\DomPDF\ServiceProvider::class,

You can optionally use the facade for shorter code. Add this to your facades:

    'PDF' => Seguce92\DomPDF\Facade::class,

### Lumen:

After updating composer add the following lines to register provider in `bootstrap/app.php`

  ```php
  $app->register(\Seguce92\DomPDF\ServiceProvider::class);
  ```

To change the configuration, copy the config file to your config folder and enable it in `bootstrap/app.php`:

  ```php
  $app->configure('dompdf');
  ```

## Using

You can create a new DOMPDF instance and load a HTML string, file or view name. You can save it to a file, or stream (show in browser) or download.

    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->stream();

Or use the facade:

    $pdf = PDF::loadView('pdf.invoice', $data);
    return $pdf->download('invoice.pdf');

You can chain the methods:

    return PDF::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');

You can change the orientation and paper size, and hide or show errors (by default, errors are shown when debug is on)

    PDF::loadHTML($html)->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save('myfile.pdf')

You can add watermarks of type image and text

    ```php
    $pdf = App::make('dompdf.wrapper');
    $pdf->setWatermarkImage('path/to/image.png');
    $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->stream();
    ```
NOTE: enable "DOMPDF_ENABLE_FONTSUBSETTING" => true, in `app/config/dompdf.php` for correct operation of setWatermarkText [size change]

    ```php
    $pdf = App::make('dompdf.wrapper');
    $pdf->setWatermarkText('example', '150px');
    $pdf->loadHTML('<html><head><title>Hello world</title><body><h1>example</h1></body></html>');
    return $pdf->stream();
    ```

Methods property
  - setWatermarkImage

    ```php
    $pdf->setWatermarkImage($image, $opacity = 0.6, $top = '30%', $width = '100%', $height = '100%');
    ```

    ```php
    $image = path to image file *.png, *.jpeg, ect
    $opacity = values accept 1.0 - 0.11111
    $top = margin respect to top page
    $with = size image width
    $height = size image height

  - setWatermarkText

    ```php
    $pdf->setWatermarkText($text, $size = '100px', $opacity = 0.6, $rotate = '10deg', $top = '30%')
    ```

    ```php
    $text = text a view with watermark
    $size = font size
    $opacity = values accept 1.0 - 0.11111
    $rotate = rotation text in deg values  (css transform-rotate
    $top = margin respect to top page
    ```

If you need the output as a string, you can get the rendered PDF with the output() function, so you can save/output it yourself.

Use `php artisan vendor:publish` to create a config file located at `config/dompdf.php` which will allow you to define local configurations to change some settings (default paper etc).
You can also use your ConfigProvider to set certain keys.

### Tip: UTF-8 support
In your templates, set the UTF-8 Metatag:

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

### Tip: Page breaks
You can use the CSS `page-break-before`/`page-break-after` properties to create a new page.

    <style>
    .page-break {
        page-break-after: always;
    }
    </style>
    <h1>Page 1</h1>
    <div class="page-break"></div>
    <h1>Page 2</h1>

### Original Package
This DOMPDF Wrapper for Laravel is open-sourced software licensed under the [barryvdh/laravel-dompdf Repository](https://github.com/barryvdh/laravel-dompdf/)
