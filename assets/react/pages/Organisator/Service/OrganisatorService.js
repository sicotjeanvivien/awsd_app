export default class OrganisatorService {

    // DATE MANAGEMENT 
    static getWeekNumber(currentDate) {
        const startDate = new Date(currentDate.getFullYear(), 0, 1);
        let days = Math.floor((currentDate - startDate) / (24 * 60 * 60 * 1000));
        return Math.ceil(days / 7);
    }

    static getDateByWeek(weekNumber) {
        let yearStart = new Date((new Date()).getFullYear(), 0, 1);
        let dayTime = yearStart.getTime() + (weekNumber * 7 * 24 * 60 * 60 * 1000);
        let date = new Date(dayTime);
        console.log(date.getDate(), date.getDay());
        date.setDate(date.getDate() - date.getDay())
        console.log(date);


    }

    // TASK MANAGEMENT
    static getModelTasksByDay(tasks = {}) {

        let tasksByDay = {
            "1": {
                "day": {
                    "en": "Monday",
                    "fr": "Lundi"
                },
                "tasks": []
            },
            "2": {
                "day": {
                    "en": "Tuesday",
                    "fr": "Mardi"
                },
                "tasks": []
            },
            "3": {
                "day": {
                    "en": "Wednesday",
                    "fr": "Mercredi"
                },
                "tasks": []
            },
            "4": {
                "day": {
                    "en": "Thursday",
                    "fr": "Jeudi"
                },
                "tasks": []
            },
            "5": {
                "day": {
                    "en": "Friday",
                    "fr": "Vendredi"
                },
                "tasks": []
            },
            "6": {
                "day": {
                    "en": "Saturday",
                    "fr": "Samedi"
                },
                "tasks": []
            },
            "7": {
                "day": {
                    "en": "Sunday",
                    "fr": "Dimanche"
                },
                "tasks": []
            },
        };

        tasks.length && tasks.forEach((value, key) => {
            let date = new Date(value.date);
            console.log(date.getDay(), tasksByDay[date.getDay()].tasks);
            tasksByDay[date.getDay()].tasks.push(value);
        })

        return tasksByDay;
    }


}