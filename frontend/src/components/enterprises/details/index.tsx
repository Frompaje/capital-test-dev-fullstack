import { Link } from "react-router-dom";
import { ArrowLeftIcon, PencilIcon } from "lucide-react";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import {
  ENTERPRISE_STATUS_LABELS,
  ENTERPRISE_STATUS_STYLES,
} from "@/constants/enterprise";
import { formatCurrency, formatDate } from "@/helper/format";
import { useEnterprise } from "@/hooks/useEnterprise";
import { cn } from "@/lib/utils";

export function Details({ id }: { id: string }) {
  const { data: enterprise, isLoading, isError } = useEnterprise(id);

  const details = enterprise
    ? [
        {
          label: "Localidade",
          value: `${enterprise.city} · ${enterprise.state}`,
        },
        {
          label: "Valor total",
          value: formatCurrency(enterprise.total_value),
        },
        {
          label: "Valor da unidade",
          value: formatCurrency(enterprise.unit_value),
        },
        {
          label: "Quantidade de unidades",
          value: String(enterprise.units_quantity),
        },
        {
          label: "Criado em",
          value: formatDate(enterprise.created_at),
        },
        {
          label: "Atualizado em",
          value: formatDate(enterprise.updated_at),
        },
      ]
    : [];

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
          <div className="mb-6 flex flex-col gap-4">
            <Button asChild variant="ghost" className="w-fit gap-2 px-0">
              <Link to="/">
                <ArrowLeftIcon className="size-4" />
                Voltar para listagem
              </Link>
            </Button>

            <div className="flex flex-wrap items-start justify-between gap-3">
              <div className="min-w-0 space-y-1">
                <h1 className="text-xl font-bold sm:text-2xl">
                  {enterprise.name}
                </h1>
                <p className="text-sm text-muted-foreground">
                  Detalhes do empreendimento
                </p>
              </div>

              <div className="flex flex-wrap items-center gap-2">
                <Badge
                  className={cn(
                    "gap-1.5",
                    ENTERPRISE_STATUS_STYLES[enterprise.status],
                  )}
                >
                  <span className="size-1.5 rounded-full bg-current" />
                  {ENTERPRISE_STATUS_LABELS[enterprise.status]}
                </Badge>
                <Button asChild variant="outline" size="sm" className="gap-2">
                  <Link to={`/enterprises/${id}/edit`}>
                    <PencilIcon className="size-4" />
                    Editar
                  </Link>
                </Button>
              </div>
            </div>
          </div>

          <Card>
            <CardHeader>
              <CardTitle>Informações gerais</CardTitle>
              <CardDescription>
                Dados cadastrais e financeiros do empreendimento.
              </CardDescription>
            </CardHeader>
            <CardContent>
              <dl className="grid grid-cols-1 gap-4 sm:grid-cols-2">
                {details.map((detail) => (
                  <div key={detail.label} className="space-y-1">
                    <dt className="text-xs font-medium text-muted-foreground">
                      {detail.label}
                    </dt>
                    <dd className="text-sm font-medium text-foreground">
                      {detail.value}
                    </dd>
                  </div>
                ))}
              </dl>
            </CardContent>
          </Card>
        </>
      )}
    </div>
  );
}
