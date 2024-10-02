<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade; // Tambahkan ini
use IntlDateFormatter;
use DateTime;

class DateTimeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Daftarkan Blade directive
        Blade::directive('formattedDateTime', function () {
            return "<?php echo \\App\\Providers\\DateTimeServiceProvider::formatDateTime(); ?>";
        });
    }

    public static function formatDateTime($dateTime = null)
    {
        date_default_timezone_set('Asia/Makassar');
        $dateTime = $dateTime ?? new DateTime();

        $formatter = new IntlDateFormatter(
            'id_ID',
            IntlDateFormatter::LONG,
            IntlDateFormatter::SHORT,
            'Asia/Makassar',
            IntlDateFormatter::GREGORIAN,
            'dd MMMM yyyy HH:mm'
        );

        return $formatter->format($dateTime);
    }
}
