import React, { useState } from 'react';
import { ChevronLeft, ChevronRight } from 'lucide-react';
import Day from  './Day.jsx'

export default  function Calendar({ DayComponent = Day }) {
    const [currentDate, setCurrentDate] = useState(new Date());

    const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
    const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay();
    const daysInPrevMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 0).getDate();

    const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    const prevMonth = () => {
        setCurrentDate(new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1));
    };

    const nextMonth = () => {
        setCurrentDate(new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1));
    };

    const renderDays = () => {
        const days = [];
        const totalDays = 42; // 6 rows * 7 days

        // Previous month days
        for (let i = firstDayOfMonth - 1; i >= 0; i--) {
            days.push(
                <DayComponent
                    key={`prev-${daysInPrevMonth - i}`}
                    day={daysInPrevMonth - i}
                    isCurrentMonth={false}
                />
            );
        }

        // Current month days
        for (let i = 1; i <= daysInMonth; i++) {
            days.push(<DayComponent key={`current-${i}`} day={i} isCurrentMonth={true} />);
        }

        // Next month days
        for (let i = 1; days.length < totalDays; i++) {
            days.push(<DayComponent key={`next-${i}`} day={i} isCurrentMonth={false} />);
        }

        return days;
    };

    return (
        <div className="w-full max-w-md mx-auto">
            <div className="flex justify-between items-center mb-4">
                <button onClick={prevMonth} className="p-2"><ChevronLeft /></button>
                <h2 className="text-xl font-bold">
                    {monthNames[currentDate.getMonth()]} {currentDate.getFullYear()}
                </h2>
                <button onClick={nextMonth} className="p-2"><ChevronRight /></button>
            </div>
            <div className="grid grid-cols-7 gap-1">
                {['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'].map(day => (
                    <div key={day} className="font-bold text-center p-2">{day}</div>
                ))}
                {renderDays()}
            </div>
        </div>
    );
};
