import { Route, Routes } from "react-router-dom";
import { EnterprisePage } from "./page/enterprise";

export function App() {
  return (
    <Routes>
      <Route path="/" element={<EnterprisePage />} />
    </Routes>
  );
}
