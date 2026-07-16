import type { EnterpriseStatus } from "@/types/enterprise";

export const ENTERPRISE_STATUS_LABELS: Record<EnterpriseStatus, string> = {
  em_lancamento: "Em lançamento",
  em_obras: "Em obras",
  entregue: "Entregue",
};
