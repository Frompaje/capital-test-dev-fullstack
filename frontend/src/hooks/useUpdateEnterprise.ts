import { useMutation, useQueryClient } from '@tanstack/react-query'
import { toast } from 'sonner'
import {
  getApiErrorMessage,
  getApiFieldErrors,
} from '@/lib/apiErrors'
import { enterpriseService } from '@/services/enterpriseService'
import type { EnterpriseFormData } from '@/types/enterprise'

export function useUpdateEnterprise(id: string) {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: (payload: Partial<EnterpriseFormData>) =>
      enterpriseService.update(id, payload),
    onSuccess: () => {
      toast.success('Empreendimento atualizado com sucesso.')
      queryClient.invalidateQueries({ queryKey: ['enterprises'] })
      queryClient.invalidateQueries({ queryKey: ['enterprises', id] })
    },
    onError: (error: unknown) => {
      if (getApiFieldErrors(error)) {
        return
      }

      toast.error(
        getApiErrorMessage(error, 'Erro ao atualizar empreendimento.'),
      )
    },
  })
}
