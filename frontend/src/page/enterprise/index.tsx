import { Header } from "@/components/enterprises/header";
import { SubHeader } from "@/components/enterprises/sub-header";
import { List } from "@/components/enterprises/list";

export function EnterprisePage() {
  return (
    <main className="flex flex-col">
      <Header />
      <SubHeader />
      <List />
    </main>
  );
}
