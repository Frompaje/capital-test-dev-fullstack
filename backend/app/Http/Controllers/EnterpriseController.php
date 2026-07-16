<?php

namespace App\Http\Controllers;

use App\Interfaces\EnterpriseServiceInterface;
use App\Http\Dto\EnterpriseResponseDto;
use App\Http\Dto\ListEnterpriseDto;
use App\Http\Dto\ShowEnterpriseDto;
use App\Http\Dto\StoreEnterpriseDto;
use App\Models\Enterprise;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class EnterpriseController
{
    public function __construct(
        private readonly EnterpriseServiceInterface $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        try {
            $dto = ListEnterpriseDto::fromArray($request->all());

            $enterprises = $this->service->list($dto);

            return response()->json([
                'message' => 'Empreendimentos listados com sucesso.',
                'data'    => $enterprises,
            ]);
        } catch (Throwable $exception) {
            Log::error('Failed to list enterprises', [
                'filters' => $request->only(['name', 'status']),
                'error'   => $exception->getMessage(),
                'trace'   => $exception->getTraceAsString(),
            ]);

            return response()->json(['message' => 'Erro ao listar empreendimentos.'], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $dto = ShowEnterpriseDto::fromArray(['id' => $id]);
            $enterprise  = $this->service->findById($dto);

            return response()->json([
                'message' => 'Empreendimento encontrado.',
                'data'    => $enterprise->toArray(),
            ]);
        } catch (Throwable $exception) {
            Log::error('Failed to show enterprise', [
                'enterprise_id' => $id,
                'error'         => $exception->getMessage(),
                'trace'         => $exception->getTraceAsString(),
            ]);

            return response()->json(['message' => 'Erro ao buscar empreendimento.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $dto         = StoreEnterpriseDto::fromArray($request->all());
            $enterprise  = $this->service->create($dto);
            $responseDto = EnterpriseResponseDto::fromModel($enterprise);

            return response()->json([
                'message' => 'Empreendimento cadastrado com sucesso.',
                'data'    => $responseDto->toArray(),
            ], 201);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Dados inválidos.',
                'errors'  => $exception->errors(),
            ], 422);
        } catch (Throwable $exception) {
            Log::error('Failed to create enterprise', [
                'payload' => $request->all(),
                'error'   => $exception->getMessage(),
                'trace'   => $exception->getTraceAsString(),
            ]);

            return response()->json(['message' => 'Erro ao cadastrar empreendimento.'], 500);
        }
    }

    public function update(Request $request, Enterprise $enterprise): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name'            => 'sometimes|string|max:255',
                'city'            => 'sometimes|string|max:255',
                'state'           => 'sometimes|string|size:2',
                'total_value'     => 'sometimes|numeric|min:0.01',
                'units_quantity'  => 'sometimes|integer|min:1',
                'unit_value'      => 'sometimes|numeric|min:0.01',
                'status'          => 'sometimes|in:em_lancamento,em_obras,entregue',
            ]);

            $updated = $this->service->update($enterprise, $validated);

            return response()->json([
                'message' => 'Empreendimento atualizado com sucesso.',
                'data'    => $updated,
            ]);
        } catch (Throwable $exception) {
            Log::error('Failed to update enterprise', [
                'enterprise_id' => $enterprise->id,
                'payload'       => $request->all(),
                'error'         => $exception->getMessage(),
                'trace'         => $exception->getTraceAsString(),
            ]);

            return response()->json(['message' => 'Erro ao atualizar empreendimento.'], 500);
        }
    }

    public function destroy(Enterprise $enterprise): JsonResponse
    {
        try {
            $this->service->delete($enterprise);

            return response()->json(null, 204);
        } catch (Throwable $exception) {
            Log::error('Failed to delete enterprise', [
                'enterprise_id' => $enterprise->id,
                'error'         => $exception->getMessage(),
                'trace'         => $exception->getTraceAsString(),
            ]);

            return response()->json(['message' => 'Erro ao excluir empreendimento.'], 500);
        }
    }
}
