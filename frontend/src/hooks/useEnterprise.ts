import { useQuery } from '@tanstack/react-query'
import { enterpriseService } from '@/services/enterpriseService'

export function useEnterprise(id: string | undefined) {
  return useQuery({
    queryKey: ['enterprises', id],
    queryFn: () => enterpriseService.getEnterpriseById(id!),
    enabled: Boolean(id),
  })
}
