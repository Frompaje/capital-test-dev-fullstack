import { Link } from "react-router-dom";

export function Header() {
  return (
    <header className="border-b bg-background">
      <div className="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4 sm:px-6">
        <Link to="/" className="flex items-center gap-2">
          <div className="grid h-8 w-8 place-items-center rounded-md bg-primary text-primary-foreground">
            <span className="text-sm font-bold">E</span>
          </div>
          <div className="min-w-0">
            <p className="truncate text-sm font-semibold leading-tight">
              Empreendimentos
            </p>
            <p className="hidden text-xs text-muted-foreground sm:block">
              Gestão interna
            </p>
          </div>
        </Link>
      </div>
    </header>
  );
}
