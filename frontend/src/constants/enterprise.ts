import type { EnterpriseStatus } from "@/types/enterprise";

export const ENTERPRISE_STATUS_LABELS: Record<EnterpriseStatus, string> = {
  em_lancamento: "Em lançamento",
  em_obras: "Em obras",
  entregue: "Entregue",
};

export const ENTERPRISE_STATUS_STYLES: Record<EnterpriseStatus, string> = {
  em_lancamento: "border-transparent bg-sky-100 text-sky-700",
  em_obras: "border-transparent bg-orange-100 text-orange-700",
  entregue: "border-transparent bg-emerald-100 text-emerald-700",
};
