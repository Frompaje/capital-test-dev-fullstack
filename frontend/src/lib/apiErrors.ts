import { isAxiosError } from 'axios'
import type { FieldValues, Path, UseFormSetError } from 'react-hook-form'

export type ApiFieldErrors = Record<string, string[]>

interface ApiValidationResponse {
  message?: string
  errors?: ApiFieldErrors
}

export function getApiErrorMessage(
  error: unknown,
  fallback = 'Ocorreu um erro inesperado.',
): string {
  if (!isAxiosError<ApiValidationResponse>(error)) {
    return fallback
  }

  return error.response?.data?.message ?? fallback
}

export function getApiFieldErrors(error: unknown): ApiFieldErrors | null {
  if (!isAxiosError<ApiValidationResponse>(error)) {
    return null
  }

  const fieldErrors = error.response?.data?.errors

  if (!fieldErrors || typeof fieldErrors !== 'object') {
    return null
  }

  return fieldErrors
}

export function applyServerErrors<TFieldValues extends FieldValues>(
  fieldErrors: ApiFieldErrors,
  setError: UseFormSetError<TFieldValues>,
  allowedFields: string[],
) {
  Object.entries(fieldErrors).forEach(([field, messages]) => {
    if (!allowedFields.includes(field)) {
      return
    }

    const message = messages[0]
    if (!message) {
      return
    }

    setError(field as Path<TFieldValues>, {
      type: 'server',
      message,
    })
  })
}
