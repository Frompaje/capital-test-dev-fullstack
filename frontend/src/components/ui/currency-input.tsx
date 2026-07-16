import * as React from "react"
import { Input } from "@/components/ui/input"
import { formatCurrencyInput, parseCurrencyInput } from "@/helper/format"
import { cn } from "@/lib/utils"

interface CurrencyInputProps
  extends Omit<React.ComponentProps<"input">, "value" | "onChange" | "type"> {
  value?: number
  onChange?: (value: number) => void
}

function CurrencyInput({
  value = 0,
  onChange,
  onBlur,
  className,
  id,
  disabled,
  name,
  ref,
  ...props
}: CurrencyInputProps) {
  const displayValue = formatCurrencyInput(value)

  const handleChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    onChange?.(parseCurrencyInput(event.target.value))
  }

  return (
    <div className="relative">
      <span className="pointer-events-none absolute top-1/2 left-2.5 -translate-y-1/2 text-sm text-muted-foreground">
        R$
      </span>
      <Input
        id={id}
        name={name}
        type="text"
        inputMode="decimal"
        disabled={disabled}
        value={displayValue}
        onChange={handleChange}
        onBlur={onBlur}
        ref={ref}
        placeholder="0,00"
        className={cn("pl-9", className)}
        {...props}
      />
    </div>
  )
}

export { CurrencyInput }
