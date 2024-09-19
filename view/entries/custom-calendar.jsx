import {createRoot } from "react-dom/client";
import Calendar from "../component/Calendar.jsx";
import CustomDay from "../component/CustomDay.jsx";
import '../css/custom-calendar.css'
import '../css/custom-styles.css'

createRoot(document.getElementById("calendar")).render(
    <Calendar DayComponent={CustomDay} />
);