import { Link, useNavigate } from "react-router-dom";
import { ArrowLeftIcon } from "lucide-react";
import { Button } from "@/components/ui/button";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { EditEnterpriseForm } from "@/components/enterprises/edit/form";
import { useEnterprise } from "@/hooks/useEnterprise";

export function Edit({ id }: { id: string }) {
  const navigate = useNavigate();
  const { data: enterprise, isLoading, isError } = useEnterprise(id);

  return (
    <div className="mx-auto w-full max-w-6xl px-4 py-6 sm:px-6">
      {isLoading && (
        <p className="text-sm text-muted-foreground">
          Carregando empreendimento...
        </p>
      )}

      {(isError || (!isLoading && !enterprise)) && (
        <div className="flex flex-col gap-4">
          <Button asChild variant="ghost" className="w-fit gap-2 px-0">
            <Link to="/">
              <ArrowLeftIcon className="size-4" />
              Voltar
            </Link>
          </Button>
          <p className="text-sm text-destructive">
            Não foi possível carregar o empreendimento.
          </p>
        </div>
      )}

      {!isLoading && !isError && enterprise && (
        <>
          <div className="mb-6 space-y-4">
            <Button asChild variant="ghost" className="w-fit gap-2 px-0">
              <Link to={`/enterprises/${id}`}>
                <ArrowLeftIcon className="size-4" />
                Voltar para detalhes
              </Link>
            </Button>

            <div>
              <h1 className="text-xl font-bold sm:text-2xl">
                Editar empreendimento
              </h1>
              <p className="text-sm text-muted-foreground">{enterprise.name}</p>
            </div>
          </div>

          <Card>
            <CardHeader>
              <CardTitle>Dados do empreendimento</CardTitle>
              <CardDescription>
                Atualize as informações e salve as alterações.
              </CardDescription>
            </CardHeader>
            <CardContent>
              <EditEnterpriseForm
                enterprise={enterprise}
                onSuccess={() => navigate(`/enterprises/${id}`)}
                onCancel={() => navigate(`/enterprises/${id}`)}
              />
            </CardContent>
          </Card>
        </>
      )}
    </div>
  );
}
