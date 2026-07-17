import { useMutation, useQueryClient } from '@tanstack/react-query'
import { toast } from 'sonner'
import {
  getApiErrorMessage,
  getApiFieldErrors,
} from '@/lib/apiErrors'
import { enterpriseService } from '@/services/enterpriseService'
import type { EnterpriseFormData } from '@/types/enterprise'

export function useCreateEnterprise() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: (payload: EnterpriseFormData) =>
      enterpriseService.create(payload),
    onSuccess: () => {
      toast.success('Empreendimento cadastrado com sucesso.')
      queryClient.invalidateQueries({ queryKey: ['enterprises'] })
    },
    onError: (error: unknown) => {
      if (getApiFieldErrors(error)) {
        return
      }

      toast.error(
        getApiErrorMessage(error, 'Erro ao cadastrar empreendimento.'),
      )
    },
  })
}
