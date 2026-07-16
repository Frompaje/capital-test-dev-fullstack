import { useState } from 'react'
import { PlusIcon } from 'lucide-react'
import { Button } from '@/components/ui/button'
import { CreateEnterpriseModal } from '@/components/enterprises/create-modal'

export function SubHeader() {
  const [open, setOpen] = useState(false)

  return (
    <div className="mx-auto w-full max-w-6xl px-4 py-6 sm:px-6">
      <div className="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div className="min-w-0">
          <h1 className="text-xl font-bold sm:text-2xl">Empreendimentos</h1>
          <span className="text-sm text-slate-500">
            Gerencie todos os empreendimentos da incorporadora.
          </span>
        </div>

        <Button
          className="flex w-full items-center justify-center gap-2 p-5 sm:w-auto"
          onClick={() => setOpen(true)}
        >
          <PlusIcon className="size-4 text-white" /> Novo empreendimento
        </Button>
      </div>

      <CreateEnterpriseModal open={open} onOpenChange={setOpen} />
    </div>
  )
}
