<?php

namespace App\Http\Controllers;

use App\Http\Dto\ListEnterpriseDto;
use App\Http\Requests\Enterprise\Dto\EnterpriseResponseData;
use App\Http\Requests\Enterprise\Dto\StoreEnterpriseData;
use App\Http\Requests\Enterprise\Dto\UpdateEnterpriseData;
use App\Models\Enterprise;
use App\Services\EnterpriseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class EnterpriseController
{
    public function __construct(
        private readonly EnterpriseService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        try {
            $dto = ListEnterpriseDto::fromArray($request->all());
            Log::info('Listando empreendimentos');

            $enterprises = $this->service->list($dto->toArray());

            return response()->json(['message' => 'Empreendimentos listados com sucesso.', 'data' => $enterprises]);
        } catch (Throwable $exception) {
            Log::error('Failed to list enterprises', [
                'filters' => $request->only(['name', 'status']),
                'error'   => $exception->getMessage(),
                'trace'   => $exception->getTraceAsString(),
            ]);

            return response()->json(['message' => 'Erro ao listar empreendimentos.'], 500);
        }
    }
    /*
    public function show(Enterprise $enterprise): JsonResponse
    {
        try {
            return response()->json(
            );
        } catch (\Throwable $exception) {
            Log::error('Failed to show enterprise', [
                'enterprise_id' => $enterprise->id,
                'error'         => $exception->getMessage(),
                'trace'         => $exception->getTraceAsString(),
            ]);

            return response()->json(['message' => 'Erro ao buscar empreendimento.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $data = StoreEnterpriseData::fromArray($request->all());
            $enterprise = $this->service->create($data);

            return response()->json(
                EnterpriseResponseData::fromModel($enterprise),
                201
            );
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Dados inválidos.',
                'errors'  => $exception->errors(),
            ], 422);
        } catch (\Throwable $exception) {
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
            $data = UpdateEnterpriseData::fromArray($request->all());
            $updated = $this->service->update($enterprise, $data);

            return response()->json(
                EnterpriseResponseData::fromModel($updated)
            );
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Dados inválidos.',
                'errors'  => $exception->errors(),
            ], 422);
        } catch (\Throwable $exception) {
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
        } catch (\Throwable $exception) {
            Log::error('Failed to delete enterprise', [
                'enterprise_id' => $enterprise->id,
                'error'         => $exception->getMessage(),
                'trace'         => $exception->getTraceAsString(),
            ]);

            return response()->json(['message' => 'Erro ao excluir empreendimento.'], 500);
        }
    }
*/
}
