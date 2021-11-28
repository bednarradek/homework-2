<?php

declare(strict_types=1);

namespace App;

use DateTime;

class DateFormatter
{
    /**
     * Get current part of the day
     *
     * @return string
     */
    public function getPartOfDay(): string
    {
        $dateTime = $this->getDateTime();
        $currentHour = $dateTime->format('G');

        return match (true) {
            $currentHour >= 0 && $currentHour < 6 => 'Night',
            $currentHour >= 6 && $currentHour < 12 => 'Morning',
            $currentHour >= 12 && $currentHour < 18 => 'Afternoon',
            default => 'Evening'
        };
    }

    public function getDateTime(): DateTime
    {
        return new DateTime();
    }
}
