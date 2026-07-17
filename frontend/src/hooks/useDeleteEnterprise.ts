import { useMutation, useQueryClient } from '@tanstack/react-query'
import { toast } from 'sonner'
import { getApiErrorMessage } from '@/lib/apiErrors'
import { enterpriseService } from '@/services/enterpriseService'

export function useDeleteEnterprise() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: (id: string) => enterpriseService.delete(id),
    onSuccess: () => {
      toast.success('Empreendimento excluído com sucesso.')
      queryClient.invalidateQueries({ queryKey: ['enterprises'] })
    },
    onError: (error: unknown) => {
      toast.error(
        getApiErrorMessage(error, 'Erro ao excluir empreendimento.'),
      )
    },
  })
}
