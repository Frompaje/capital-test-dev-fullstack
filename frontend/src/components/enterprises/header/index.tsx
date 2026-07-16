import { Separator } from "@/components/ui/separator"

export function Header() {
  return (
    <header className="flex w-full flex-col">

      <div className="flex items-center gap-3 px-4 py-2">
        <div className="flex size-10 shrink-0 items-center justify-center rounded-lg bg-slate-900 text-sm font-semibold text-white">
          E
        </div>

        <div className="flex flex-col">
          <h1 className="text-lg font-semibold leading-tight text-slate-900">
            Empreendimentos
          </h1>
          <p className="text-sm text-slate-500">Gestão interna</p>
        </div>
      </div>

      <Separator className="w-full" />
    </header>
  )
}