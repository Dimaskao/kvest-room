<?php

declare(strict_types=1);

namespace App\Util;

final class SlugUtil
{
    public static function generate(string $str): string
    {
        $result = function_exists('mb_strtolower') ? mb_strtolower($str) : strtolower($str);
        $result = strtr($result, ['і' => 'i', 'ґ' => 'g', 'ї' => 'i', 'є' => 'e', 'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => '']);
        $result = \preg_replace('/[\.\-]/', '', $result);
        $result = \preg_replace('/[\s]+/', '-', $result);

        return $result;
    }
}
