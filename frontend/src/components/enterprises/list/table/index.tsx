import { Link } from "react-router-dom";
import { EyeIcon, PencilIcon, Trash2Icon } from "lucide-react";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import {
  ENTERPRISE_STATUS_LABELS,
  ENTERPRISE_STATUS_STYLES,
} from "@/constants/enterprise";
import { formatCurrency } from "@/helper/format";
import { cn } from "@/lib/utils";
import type { Enterprise } from "@/types/enterprise";

interface props {
  enterprises: Enterprise[];
  isLoading: boolean;
  isError: boolean;
}

export function TableComponent({
  enterprises,
  isLoading,
  isError,
}: props) {
  return (
    <div className="min-h-[560px]">
      <Table className="table-fixed">
        <colgroup>
          <col className="w-[22%]" />
          <col className="w-[16%]" />
          <col className="w-[16%]" />
          <col className="w-[14%]" />
          <col className="w-[14%]" />
          <col className="w-[8%]" />
          <col className="w-[10%]" />
        </colgroup>
        <TableHeader>
          <TableRow className="hover:bg-transparent">
            <TableHead className="px-4 text-muted-foreground">Nome</TableHead>
            <TableHead className="px-4 text-muted-foreground">
              Localidade
            </TableHead>
            <TableHead className="px-4 text-muted-foreground">Status</TableHead>
            <TableHead className="px-4 text-muted-foreground">
              Valor total
            </TableHead>
            <TableHead className="px-4 text-muted-foreground">
              Valor da unidade
            </TableHead>
            <TableHead className="px-4 text-muted-foreground">
              Unidades
            </TableHead>
            <TableHead className="px-4" />
          </TableRow>
        </TableHeader>
        <TableBody>
          {isLoading && (
            <TableRow>
              <TableCell
                colSpan={7}
                className="h-[520px] px-4 text-center text-muted-foreground"
              >
                Carregando empreendimentos...
              </TableCell>
            </TableRow>
          )}

          {isError && (
            <TableRow>
              <TableCell
                colSpan={7}
                className="h-[520px] px-4 text-center text-destructive"
              >
                Não foi possível carregar os empreendimentos.
              </TableCell>
            </TableRow>
          )}

          {!isLoading && !isError && enterprises.length === 0 && (
            <TableRow>
              <TableCell
                colSpan={7}
                className="h-[520px] px-4 text-center text-muted-foreground"
              >
                Nenhum empreendimento encontrado.
              </TableCell>
            </TableRow>
          )}

          {!isLoading &&
            !isError &&
            enterprises.map((enterprise) => (
              <TableRow key={enterprise.id} className="h-12">
                <TableCell className="max-w-0 truncate px-4 py-3 font-medium text-foreground">
                  <Link
                    to={`/enterprises/${enterprise.id}`}
                    className="hover:underline"
                  >
                    {enterprise.name}
                  </Link>
                </TableCell>
                <TableCell className="max-w-0 truncate px-4 py-3 text-muted-foreground">
                  {enterprise.city} · {enterprise.state}
                </TableCell>
                <TableCell className="px-4 py-3">
                  <Badge
                    className={cn(
                      "gap-1.5",
                      ENTERPRISE_STATUS_STYLES[enterprise.status],
                    )}
                  >
                    <span className="size-1.5 rounded-full bg-current" />
                    {ENTERPRISE_STATUS_LABELS[enterprise.status]}
                  </Badge>
                </TableCell>
                <TableCell className="truncate px-4 py-3">
                  {formatCurrency(enterprise.total_value)}
                </TableCell>
                <TableCell className="truncate px-4 py-3">
                  {formatCurrency(enterprise.unit_value)}
                </TableCell>
                <TableCell className="px-4 py-3">
                  {enterprise.units_quantity}
                </TableCell>
                <TableCell className="px-4 py-3">
                  <div className="flex items-center justify-end gap-1">
                    <Button
                      asChild
                      variant="ghost"
                      size="icon-sm"
                      aria-label={`Ver detalhes de ${enterprise.name}`}
                    >
                      <Link to={`/enterprises/${enterprise.id}`}>
                        <EyeIcon className="size-4 text-muted-foreground" />
                      </Link>
                    </Button>
                    <Button
                      asChild
                      variant="ghost"
                      size="icon-sm"
                      aria-label={`Editar ${enterprise.name}`}
                    >
                      <Link to={`/enterprises/${enterprise.id}/edit`}>
                        <PencilIcon className="size-4 text-muted-foreground" />
                      </Link>
                    </Button>
                    <Button
                      type="button"
                      variant="ghost"
                      size="icon-sm"
                      aria-label={`Excluir ${enterprise.name}`}
                    >
                      <Trash2Icon className="size-4 text-destructive" />
                    </Button>
                  </div>
                </TableCell>
              </TableRow>
            ))}
        </TableBody>
      </Table>
    </div>
  );
}
