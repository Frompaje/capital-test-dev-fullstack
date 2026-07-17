import { Filter } from "@/components/enterprises/filter";
import { TableComponent } from "@/components/enterprises/list/table";
import { Pagination } from "@/components/ui/pagination";
import { DEFAULT_PER_PAGE } from "@/constants/pagination";
import { useEnterpriseListParams } from "@/hooks/useEnterpriseListParams";
import { useListEnterprises } from "@/hooks/useListEnterprises";

export function List() {
  const {
    searchInput,
    setSearchInput,
    name,
    status,
    page,
    setStatus,
    setPage,
  } = useEnterpriseListParams();

  const { data, isLoading, isError } = useListEnterprises({
    name: name || undefined,
    status: status === "all" ? undefined : status,
    page,
    per_page: DEFAULT_PER_PAGE,
  });

  const list = {
    enterprises: data?.data ?? [],
    currentPage: data?.meta?.current_page ?? page,
    lastPage: data?.meta?.last_page ?? 1,
  };

  return (
    <div className="mx-auto w-full max-w-6xl px-4 pb-8 sm:px-6">
      <div className="overflow-hidden rounded-xl border bg-card">
        <div className="border-b p-4">
          <Filter
            search={searchInput}
            onSearchChange={setSearchInput}
            status={status}
            onStatusChange={setStatus}
          />
        </div>

        <TableComponent
          enterprises={list.enterprises}
          isLoading={isLoading}
          isError={isError}
        />

        <div className="flex h-14 items-center justify-center border-t px-4">
          {list.lastPage > 1 && (
            <Pagination
              currentPage={list.currentPage}
              lastPage={list.lastPage}
              onPageChange={setPage}
            />
          )}
        </div>
      </div>
    </div>
  );
}
