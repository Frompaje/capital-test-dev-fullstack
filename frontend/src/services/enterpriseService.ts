import { api } from '@/lib/axios'
import type {
  ApiResponse,
  Enterprise,
  EnterpriseFormData,
  ListEnterprisesParams,
} from '@/types/enterprise'

class EnterpriseService {
  private readonly path = '/enterprises'

  async list(
    params: ListEnterprisesParams,
  ): Promise<ApiResponse<Enterprise[]>> {
    const { data } = await api.get<ApiResponse<Enterprise[]>>(this.path, {
      params: {
        name: params.name,
        status: params.status,
        page: params.page,
        per_page: params.per_page,
      },
    })

    return data
  }

  async getEnterpriseById(id: string): Promise<Enterprise> {
    const { data } = await api.get<ApiResponse<Enterprise>>(`${this.path}/${id}`)
    return data.data
  }

  async create(payload: EnterpriseFormData): Promise<Enterprise> {
    const { data } = await api.post<ApiResponse<Enterprise>>(this.path, payload)
    return data.data
  }

  async update(
    id: string,
    payload: Partial<EnterpriseFormData>,
  ): Promise<Enterprise> {
    const { data } = await api.put<ApiResponse<Enterprise>>(
      `${this.path}/${id}`,
      payload,
    )
    return data.data
  }

  async delete(id: string): Promise<void> {
    await api.delete(`${this.path}/${id}`)
  }
}

export const enterpriseService = new EnterpriseService()