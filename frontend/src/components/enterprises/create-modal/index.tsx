import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from "@/components/ui/dialog";
import { CreateEnterpriseForm } from "./form";

interface CreateEnterpriseModalProps {
  open: boolean;
  onOpenChange: (open: boolean) => void;
}

export function CreateEnterpriseModal({
  open,
  onOpenChange,
}: CreateEnterpriseModalProps) {
  const handleClose = () => {
    onOpenChange(false);
  };

  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent className="max-h-[90vh] w-full max-w-[calc(100%-2rem)] overflow-y-auto sm:max-w-lg">
        <DialogHeader>
          <DialogTitle>Novo empreendimento</DialogTitle>
          <DialogDescription>
            Preencha os dados para cadastrar um novo empreendimento.
          </DialogDescription>
        </DialogHeader>

        {open && (
          <CreateEnterpriseForm
            onSuccess={handleClose}
            onCancel={handleClose}
          />
        )}
      </DialogContent>
    </Dialog>
  );
}
