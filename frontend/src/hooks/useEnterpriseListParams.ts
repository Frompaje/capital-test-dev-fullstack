import { useEffect, useState } from 'react'
import { useSearchParams } from 'react-router-dom'
import { SEARCH_DEBOUNCE_MS } from '@/constants/searchDebounceMs'
import { useDebounce } from '@/hooks/useDebounce'
import type { EnterpriseStatus } from '@/types/enterprise'
import type { FilterStatus } from '@/components/enterprises/filter'

const ENTERPRISE_STATUSES: EnterpriseStatus[] = [
  'em_lancamento',
  'em_obras',
  'entregue',
]

function parseStatus(value: string | null): FilterStatus {
  if (value && ENTERPRISE_STATUSES.includes(value as EnterpriseStatus)) {
    return value as EnterpriseStatus
  }

  return 'all'
}

function parsePage(value: string | null): number {
  const page = Number(value)

  if (!Number.isInteger(page) || page < 1) {
    return 1
  }

  return page
}

export function useEnterpriseListParams() {
  const [searchParams, setSearchParams] = useSearchParams()

  const name = searchParams.get('name') ?? ''
  const status = parseStatus(searchParams.get('status'))
  const page = parsePage(searchParams.get('page'))

  const [searchInput, setSearchInput] = useState(name)
  const [previousName, setPreviousName] = useState(name)
  const debouncedSearch = useDebounce(searchInput, SEARCH_DEBOUNCE_MS)

  if (name !== previousName) {
    setPreviousName(name)
    setSearchInput(name)
  }

  useEffect(() => {
    if (debouncedSearch === name) {
      return
    }

    setSearchParams(
      (currentParams) => {
        const nextParams = new URLSearchParams(currentParams)

        if (debouncedSearch) {
          nextParams.set('name', debouncedSearch)
        } else {
          nextParams.delete('name')
        }

        nextParams.delete('page')

        return nextParams
      },
      { replace: true },
    )
  }, [debouncedSearch, name, setSearchParams])

  const setStatus = (nextStatus: FilterStatus) => {
    setSearchParams((currentParams) => {
      const nextParams = new URLSearchParams(currentParams)

      if (nextStatus === 'all') {
        nextParams.delete('status')
      } else {
        nextParams.set('status', nextStatus)
      }

      nextParams.delete('page')

      return nextParams
    })
  }

  const setPage = (nextPage: number) => {
    setSearchParams((currentParams) => {
      const nextParams = new URLSearchParams(currentParams)

      if (nextPage <= 1) {
        nextParams.delete('page')
      } else {
        nextParams.set('page', String(nextPage))
      }

      return nextParams
    })
  }

  return {
    searchInput,
    setSearchInput,
    name,
    status,
    page,
    setStatus,
    setPage,
  }
}
