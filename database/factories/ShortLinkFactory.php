<?php
/*
 * Projeto: urlshortener
 * Arquivo: ShortLinkFactory.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 06/06/2021 3:40:52 pm
 * Last Modified:  06/06/2021 3:51:21 pm
 * Modificado por: Leonardo Nascimento - <leonardo.nascimento21@gmail.com>
 * ---------------------------------------------------------------------
 * Copyright (c) 2021 Leonardo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */

namespace Database\Factories;

use App\Models\ShortLink;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShortLinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShortLink::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'link' => $this->faker->url,
            'shortlink' => Str::random(8),
            'expiration_date' => $this->faker->dateTimeInInterval($startDate = '+7 days', $interval = '+ 1 year', $timezone = null) 
        ];
    }
}
