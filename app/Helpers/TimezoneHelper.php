<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TimezoneHelper
{
    /**
     * Mapeo de países a timezones
     */
    public static function getTimezonesByCountry()
    {
        return [
            'PE' => 'America/Lima',
            'AR' => 'America/Argentina/Buenos_Aires', 
            'CL' => 'America/Santiago',
            'CO' => 'America/Bogota',
            'MX' => 'America/Mexico_City',
            'US' => 'America/New_York',
            'BR' => 'America/Sao_Paulo',
            'EC' => 'America/Guayaquil',
            'VE' => 'America/Caracas',
            'UY' => 'America/Montevideo',
            'PY' => 'America/Asuncion',
            'BO' => 'America/La_Paz',
        ];
    }

    /**
     * Obtener timezone por país
     */
    public static function getTimezoneByCountry($country)
    {
        $timezones = self::getTimezonesByCountry();
        return $timezones[$country] ?? 'America/Lima';
    }

    /**
     * Convertir fecha al timezone del usuario autenticado
     */
    public static function toUserTimezone($date, $user = null)
    {
        $user = $user ?? Auth::user();
        
        if (!$user || !$date) {
            return $date;
        }

        return Carbon::parse($date)->setTimezone($user->timezone);
    }

    /**
     * Formatear fecha con timezone del usuario
     */
    public static function formatForUser($date, $format = 'd/m/Y H:i', $user = null)
    {
        if (!$date) {
            return '-';
        }

        $convertedDate = self::toUserTimezone($date, $user);
        return $convertedDate ? $convertedDate->format($format) : '-';
    }

    /**
     * Formatear fecha con timezone del usuario mostrando la zona horaria
     */
    public static function formatForUserWithTimezone($date, $format = 'd/m/Y H:i', $user = null)
    {
        if (!$date) {
            return '-';
        }

        $user = $user ?? Auth::user();
        $formatted = self::formatForUser($date, $format, $user);
        $timezone = $user ? $user->timezone : 'UTC';
        
        return $formatted . ' (' . $timezone . ')';
    }

    /**
     * Obtener lista de todos los timezones disponibles
     */
    public static function getAllTimezones()
    {
        return [
            'America/Lima' => 'Perú (UTC-5)',
            'America/Argentina/Buenos_Aires' => 'Argentina (UTC-3)',
            'America/Santiago' => 'Chile (UTC-3)',
            'America/Bogota' => 'Colombia (UTC-5)',
            'America/Mexico_City' => 'México (UTC-6)',
            'America/New_York' => 'Estados Unidos Este (UTC-5)',
            'America/Los_Angeles' => 'Estados Unidos Oeste (UTC-8)',
            'America/Sao_Paulo' => 'Brasil (UTC-3)',
            'America/Guayaquil' => 'Ecuador (UTC-5)',
            'America/Caracas' => 'Venezuela (UTC-4)',
            'America/Montevideo' => 'Uruguay (UTC-3)',
            'America/Asuncion' => 'Paraguay (UTC-3)',
            'America/La_Paz' => 'Bolivia (UTC-4)',
        ];
    }

    /**
     * Obtener offset de timezone en horas
     */
    public static function getTimezoneOffset($timezone)
    {
        $dateTime = new \DateTime('now', new \DateTimeZone($timezone));
        return $dateTime->getOffset() / 3600;
    }

    /**
     * Convertir de UTC a timezone específico
     */
    public static function fromUTC($date, $timezone)
    {
        if (!$date) {
            return null;
        }

        return Carbon::parse($date)->utc()->setTimezone($timezone);
    }

    /**
     * Convertir a UTC desde timezone específico
     */
    public static function toUTC($date, $timezone)
    {
        if (!$date) {
            return null;
        }

        return Carbon::parse($date, $timezone)->utc();
    }
}