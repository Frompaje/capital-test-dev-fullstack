import { Controller, useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { Button } from "@/components/ui/button";
import { CurrencyInput } from "@/components/ui/currency-input";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { DialogFooter } from "@/components/ui/dialog";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { BRAZILIAN_STATES } from "@/constants/location";
import { ENTERPRISE_STATUS_LABELS } from "@/constants/enterprise";
import { useCreateEnterprise } from "@/hooks/useCreateEnterprise";
import {
  applyServerErrors,
  getApiFieldErrors,
} from "@/lib/apiErrors";
import {
  defaultEnterpriseFormValues,
  enterpriseFormSchema,
  type EnterpriseFormSchema,
} from "@/schemas/enterprise";

interface CreateEnterpriseFormProps {
  onSuccess: () => void;
  onCancel: () => void;
}

export function CreateEnterpriseForm({
  onSuccess,
  onCancel,
}: CreateEnterpriseFormProps) {
  const { mutateAsync, isPending } = useCreateEnterprise();

  const {
    register,
    control,
    handleSubmit,
    reset,
    setError,
    formState: { errors, isValid },
  } = useForm<EnterpriseFormSchema>({
    resolver: zodResolver(enterpriseFormSchema),
    defaultValues: defaultEnterpriseFormValues,
    mode: "onSubmit",
  });

  const handleCreateEnterprise = async (data: EnterpriseFormSchema) => {
    try {
      await mutateAsync(data);
      reset(defaultEnterpriseFormValues);
      onSuccess();
    } catch (error) {
      const fieldErrors = getApiFieldErrors(error);

      if (fieldErrors) {
        applyServerErrors(
          fieldErrors,
          setError,
          Object.keys(defaultEnterpriseFormValues),
        );
      }
    }
  };

  const handleCancel = () => {
    reset(defaultEnterpriseFormValues);
    onCancel();
  };

  return (
    <form
      onSubmit={handleSubmit(handleCreateEnterprise)}
      className="space-y-4"
    >
      <div className="space-y-2">
        <Label htmlFor="name">Nome</Label>
        <Input id="name" {...register("name")} />
        {errors.name && (
          <p className="text-sm text-destructive">{errors.name.message}</p>
        )}
      </div>

      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div className="space-y-2">
          <Label htmlFor="city">Cidade</Label>
          <Input id="city" {...register("city")} />
          {errors.city && (
            <p className="text-sm text-destructive">{errors.city.message}</p>
          )}
        </div>

        <div className="space-y-2">
          <Label>Estado</Label>
          <Controller
            name="state"
            control={control}
            render={({ field }) => (
              <Select value={field.value} onValueChange={field.onChange}>
                <SelectTrigger className="w-full">
                  <SelectValue placeholder="UF" />
                </SelectTrigger>
                <SelectContent>
                  {BRAZILIAN_STATES.map((state) => (
                    <SelectItem key={state} value={state}>
                      {state}
                    </SelectItem>
                  ))}
                </SelectContent>
              </Select>
            )}
          />
          {errors.state && (
            <p className="text-sm text-destructive">{errors.state.message}</p>
          )}
        </div>
      </div>

      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div className="space-y-2">
          <Label htmlFor="total_value">Valor total</Label>
          <Controller
            name="total_value"
            control={control}
            render={({ field }) => (
              <CurrencyInput
                id="total_value"
                name={field.name}
                value={field.value}
                onChange={field.onChange}
                onBlur={field.onBlur}
                ref={field.ref}
              />
            )}
          />
          {errors.total_value && (
            <p className="text-sm text-destructive">
              {errors.total_value.message}
            </p>
          )}
        </div>

        <div className="space-y-2">
          <Label htmlFor="unit_value">Valor da unidade</Label>
          <Controller
            name="unit_value"
            control={control}
            render={({ field }) => (
              <CurrencyInput
                id="unit_value"
                name={field.name}
                value={field.value}
                onChange={field.onChange}
                onBlur={field.onBlur}
                ref={field.ref}
              />
            )}
          />
          {errors.unit_value && (
            <p className="text-sm text-destructive">
              {errors.unit_value.message}
            </p>
          )}
        </div>
      </div>

      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div className="space-y-2">
          <Label htmlFor="units_quantity">Quantidade de unidades</Label>
          <Input
            id="units_quantity"
            type="number"
            {...register("units_quantity", { valueAsNumber: true })}
          />
          {errors.units_quantity && (
            <p className="text-sm text-destructive">
              {errors.units_quantity.message}
            </p>
          )}
        </div>

        <div className="space-y-2">
          <Label>Status</Label>
          <Controller
            name="status"
            control={control}
            render={({ field }) => (
              <Select value={field.value} onValueChange={field.onChange}>
                <SelectTrigger className="w-full">
                  <SelectValue placeholder="Status" />
                </SelectTrigger>
                <SelectContent>
                  {Object.entries(ENTERPRISE_STATUS_LABELS).map(
                    ([value, label]) => (
                      <SelectItem key={value} value={value}>
                        {label}
                      </SelectItem>
                    ),
                  )}
                </SelectContent>
              </Select>
            )}
          />
          {errors.status && (
            <p className="text-sm text-destructive">{errors.status.message}</p>
          )}
        </div>
      </div>

      <DialogFooter className="flex-col gap-2 sm:flex-row">
        <Button
          type="button"
          variant="outline"
          className="w-full sm:w-auto"
          onClick={handleCancel}
          disabled={isPending}
        >
          Cancelar
        </Button>
        <Button
          type="submit"
          className="w-full sm:w-auto"
          disabled={isPending || !isValid}
        >
          {isPending ? "Cadastrando..." : "Cadastrar"}
        </Button>
      </DialogFooter>
    </form>
  );
}
