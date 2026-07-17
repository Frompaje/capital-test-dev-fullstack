import { z } from 'zod'
import type { EnterpriseFormData } from '@/types/enterprise'

export const enterpriseFormSchema = z.object({
  name: z.string().min(1, 'Nome é obrigatório').max(255),
  city: z.string().min(1, 'Cidade é obrigatória').max(255),
  state: z.string().length(2, 'Estado deve ter 2 caracteres'),
  total_value: z
    .number({ error: 'Valor total deve ser um número' })
    .gt(0, 'Valor total deve ser maior que zero'),
  units_quantity: z
    .number({ error: 'Quantidade deve ser um número' })
    .int('Quantidade deve ser um número inteiro')
    .min(1, 'Quantidade deve ser maior que zero'),
  unit_value: z
    .number({ error: 'Valor da unidade deve ser um número' })
    .gt(0, 'Valor da unidade deve ser maior que zero'),
  status: z.enum(['em_lancamento', 'em_obras', 'entregue'], {
    message: 'Status inválido',
  }),
})

export type EnterpriseFormSchema = z.infer<typeof enterpriseFormSchema>

export const defaultEnterpriseFormValues: EnterpriseFormData = {
  name: '',
  city: '',
  state: '',
  total_value: 0,
  units_quantity: 0,
  unit_value: 0,
  status: 'em_lancamento',
}
