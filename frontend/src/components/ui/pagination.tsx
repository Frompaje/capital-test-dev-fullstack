import { ChevronLeftIcon, ChevronRightIcon } from "lucide-react"
import { Button } from "@/components/ui/button"
import { cn } from "@/lib/utils"

export interface PaginationProps {
  currentPage: number
  lastPage: number
  onPageChange: (page: number) => void
}

export function Pagination({
  currentPage,
  lastPage,
  onPageChange,
}: PaginationProps) {
  if (lastPage <= 1) {
    return null
  }

  const pages = Array.from({ length: lastPage }, (_, index) => index + 1)

  return (
    <div className="flex items-center justify-center gap-1">
      <Button
        type="button"
        variant="ghost"
        size="sm"
        disabled={currentPage <= 1}
        onClick={() => onPageChange(currentPage - 1)}
        className="gap-1 text-muted-foreground"
      >
        <ChevronLeftIcon className="size-4" />
        Anterior
      </Button>

      {pages.map((page) => {
        const isActive = page === currentPage

        return (
          <Button
            key={page}
            type="button"
            variant="ghost"
            size="icon-sm"
            onClick={() => onPageChange(page)}
            className={cn(
              "text-muted-foreground",
              isActive &&
                "border bg-background font-medium text-foreground shadow-sm",
            )}
          >
            {page}
          </Button>
        )
      })}

      <Button
        type="button"
        variant="ghost"
        size="sm"
        disabled={currentPage >= lastPage}
        onClick={() => onPageChange(currentPage + 1)}
        className="gap-1 text-muted-foreground"
      >
        Próximo
        <ChevronRightIcon className="size-4" />
      </Button>
    </div>
  )
}
