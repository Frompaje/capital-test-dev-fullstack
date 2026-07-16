import { Header } from "@/components/enterprises/header";
import { Button } from "@/components/ui/button";
import { PlusIcon } from "lucide-react";

export function EnterprisePage() {
  return (
    <main className="flex flex-col">
      <Header />

      <div className="mx-auto w-full max-w-6xl px-4 py-6 sm:px-6">
        <div className="flex items-center justify-between gap-4">
          <div>
            <h1 className="text-2xl font-bold">Empreendimentos</h1>
            <span className="text-sm text-slate-500">
              Gerencie todos os empreendimentos da incorporadora.
            </span>
          </div>
          <Button className="flex items-center gap-2 p-5">
            <PlusIcon className="size-4 text-white" /> Novo empreendimento
          </Button>
        </div>
      </div>
    </main>
  );
}
