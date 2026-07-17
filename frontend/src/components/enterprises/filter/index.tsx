import { SearchIcon } from "lucide-react";
import { Input } from "@/components/ui/input";
import { Tabs, TabsList, TabsTrigger } from "@/components/ui/tabs";
import type { EnterpriseStatus } from "@/types/enterprise";

export type FilterStatus = EnterpriseStatus | "all";

interface props {
  search: string;
  onSearchChange: (value: string) => void;
  status: FilterStatus;
  onStatusChange: (status: FilterStatus) => void;
}

export function Filter({
  search,
  onSearchChange,
  status,
  onStatusChange,
}: props) {
  return (
    <div className="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div className="relative w-full sm:max-w-xs">
        <SearchIcon className="absolute top-1/2 left-3 size-4 -translate-y-1/2 text-muted-foreground" />
        <Input
          placeholder="Buscar por nome..."
          value={search}
          onChange={(event) => onSearchChange(event.target.value)}
          className="pl-9"
        />
      </div>

      <Tabs
        value={status}
        onValueChange={(value) => onStatusChange(value as FilterStatus)}
        className="w-full min-w-0 sm:w-auto"
      >
        <div className="overflow-x-auto">
          <TabsList>
            <TabsTrigger value="all">Todos</TabsTrigger>
            <TabsTrigger value="em_lancamento">Em lançamento</TabsTrigger>
            <TabsTrigger value="em_obras">Em obras</TabsTrigger>
            <TabsTrigger value="entregue">Entregue</TabsTrigger>
          </TabsList>
        </div>
      </Tabs>
    </div>
  );
}
