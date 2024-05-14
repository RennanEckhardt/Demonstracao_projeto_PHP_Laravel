<?php

namespace Tests\Unit\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\UserController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Testing\RefreshDatabase; 
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\WithFaker;



class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    //Testa a função ping no UserController
    public function testPing()
    {
        $controller = new UserController();

        $response = $controller->ping();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertEquals(200, $response->getStatusCode());

        $expectedContent = [
            'status' => 'sucesso',
            'mensagem' => 'O servidor está online e pronto para atender solicitações.',
            'horario' => 'Hora atual do servidor: ' . now()->toDayDateTimeString()
        ];
        $this->assertEquals($expectedContent, $response->getData(true));
    }
    //Teste a função index no UserController

    public function testIndex()
    {
        User::factory()->count(3)->create();

        $controller = new UserController();

        $response = $controller->index();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertArrayHasKey('status', $response->getData(true));
        $this->assertEquals('sucesso', $response->getData(true)['status']);

        $this->assertArrayHasKey('data', $response->getData(true));
        $users = $response->getData(true)['data'];
        $this->assertCount(3, $users); 
    }

        //Teste a função Show no UserController

    public function testShow()
    {
        $user = User::factory()->create();

        $controller = new UserController();

        $response = $controller->show($user->id);

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertEquals(200, $response->getStatusCode());

        $expectedContent = [
            'status' => 'sucesso',
            'data' => $user->toArray(),
        ];
        $this->assertEquals($expectedContent, $response->getData(true));
    }

        //Teste a função show no UserController com resultado negativo

    public function testShowUsuarioNaoEncontrado()
    {
        $nonExistentId = 9999;

        $controller = new UserController();

        $response = $controller->show($nonExistentId);

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertEquals(404, $response->getStatusCode());

        $expectedContent = [
            'status' => 'erro',
            'mensagem' => 'Usuário não encontrado.',
        ];
        $this->assertEquals($expectedContent, $response->getData(true));
    }
    
}
