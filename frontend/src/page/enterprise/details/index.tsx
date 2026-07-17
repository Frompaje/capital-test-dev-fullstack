import { useParams } from "react-router-dom";
import { Header } from "@/components/enterprises/header";
import { Details } from "@/components/enterprises/details";

export function EnterpriseDetailsPage() {
  const { id } = useParams<{ id: string }>();

  return (
    <main className="flex flex-col">
      <Header />
      {id ? (
        <Details id={id} />
      ) : (
        <div className="mx-auto w-full max-w-6xl px-4 py-6 sm:px-6">
          <p className="text-sm text-destructive">
            Empreendimento não encontrado.
          </p>
        </div>
      )}
    </main>
  );
}
