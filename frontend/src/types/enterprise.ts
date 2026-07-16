export type EnterpriseStatus = 'em_lancamento' | 'em_obras' | 'entregue'

export interface Enterprise {
  id: string
  name: string
  city: string
  state: string
  total_value: string
  units_quantity: number
  unit_value: string
  status: EnterpriseStatus
  created_at: string
  updated_at: string
}

export interface EnterpriseFormData {
  name: string
  city: string
  state: string
  total_value: number
  units_quantity: number
  unit_value: number
  status: EnterpriseStatus
}

export interface PaginationMeta {
  current_page: number
  per_page: number
  total: number
  last_page: number
}

export interface ListEnterprisesParams {
  name?: string
  status?: EnterpriseStatus | ''
  page?: number
  per_page?: number
}

export interface ApiResponse<T> {
  message: string
  data: T
  meta?: PaginationMeta
}

