import { Route, Routes } from "react-router-dom";
import { EnterprisePage } from "./page/enterprise";
import { EnterpriseDetailsPage } from "./page/enterprise/details";
import { EnterpriseEditPage } from "./page/enterprise/edit";

export function App() {
  return (
    <Routes>
      <Route path="/" element={<EnterprisePage />} />
      <Route path="/enterprises/:id" element={<EnterpriseDetailsPage />} />
      <Route path="/enterprises/:id/edit" element={<EnterpriseEditPage />} />
    </Routes>
  );
}
