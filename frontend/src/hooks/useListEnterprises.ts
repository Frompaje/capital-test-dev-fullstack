import { keepPreviousData, useQuery } from '@tanstack/react-query'
import { enterpriseService } from '@/services/enterpriseService'
import type { ListEnterprisesParams } from '@/types/enterprise'

export function useListEnterprises(params: ListEnterprisesParams) {
  return useQuery({
    queryKey: ['enterprises', params],
    queryFn: () => enterpriseService.list(params),
    placeholderData: keepPreviousData,
  })
}
