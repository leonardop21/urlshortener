<?php
/*
 * Projeto: urlshortener
 * Arquivo: ShortLinkApiTest.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 06/06/2021 3:39:31 pm
 * Last Modified: Mon Jun 07 2021
 * Modificado por: Leonardo Nascimento - <leonardo.nascimento21@gmail.com>
 * ---------------------------------------------------------------------
 * Copyright (c) 2021 Leonardo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shortlink;


class ShortLinkApiTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected $faker;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testCreateShortLink(){
       // Testando somente com url
        $response = $this->json('GET', '/api/v1/encurtar?link=' . $this->faker->url);
        $response->assertStatus(200)
        ->assertJsonStructure(['shortlink']);

    }
    public function testCreateShortLinkSlug(){
        // Personalizando Slug
        $url = $this->faker->url;
        $slug = 'meu-slug-demais';
        $response = $this->json('GET', '/api/v1/encurtar?link=' . $url . '&shortlink=' . $slug);
        $response->assertStatus(200)
        ->assertJsonStructure(['shortlink']);
    }
    public function testCreateShortLinkExpires(){
        // Definindo data
        $url = $this->faker->url;

        $response = $this->json('GET', '/api/v1/encurtar?link=' . $url . '&expire=10/10/2021');
        $response->assertStatus(200)
        ->assertJsonStructure(['shortlink']);
    }
    public function testCreateShortLinkAll(){
        // Preenchendo todos os parametros
        $url = $this->faker->url;
        $slug = $this->faker->swiftBicNumber;

        $response = $this->json('GET', '/api/v1/encurtar', [
            'link' => $this->faker->url,
            'shortlink' => $this->faker->swiftBicNumber,
            'expire_adm' => '2021-10-10'
        ]);
        $response->assertStatus(200)
        ->assertJsonStructure(['shortlink']);
    }

    public function testCreateShortLinkAllPost(){
        // Preenchendo todos os parametros/post
        $url = $this->faker->url;
        $slug = $this->faker->swiftBicNumber;

        $response = $this->json('POST', '/api/v1/encurtar?link=' . $url . '&shortlink=' . $slug . '&expire=10/10/2010');
        $response->assertStatus(200)
        ->assertJsonStructure(['shortlink']);
    }

    public function testAcessLink(){
        // Visitando a url
      $data =  Shortlink::create([
            'link' => $this->faker->url,
            'shortlink' => $this->faker->swiftBicNumber,
            'expiration_date' => '10/10/2021'
        ]);

         $response = $this->get('/'. $data->shortlink);
         $response->assertStatus(302);
     }

     public function testAcessLinkExpired(){
        // Visitando a url expirada
      $data =  Shortlink::create([
            'link' => $this->faker->url,
            'shortlink' => $this->faker->swiftBicNumber,
            'expiration_date' => '10/03/2020'
        ]);

         $response = $this->get('/'. $data->shortlink);
         $response->assertStatus(404);
     }
}
