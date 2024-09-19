export default function CustomDay({ day, isCurrentMonth }) {
    return (
        <div className={`custom-day p-2 text-center  ${isCurrentMonth ? 'bg-blue-100 hover:bg-blue-200' : 'bg-gray-100 text-gray-400'}`}>
            {day}
        </div>
    );
};