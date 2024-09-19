
export default function Day({day, isCurrentMonth}) {
    return (
        <div className={`p-2 text-center border hover:bg-gray-100 ${isCurrentMonth ? '' : 'text-gray-400'}`}>
            {day}
        </div>
    )
}