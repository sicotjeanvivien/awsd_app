export default class OrganisatorService {

	// DATE MANAGEMENT 
	static getWeekNumber(currentDate) {
		const startDate = new Date(currentDate.getFullYear(), 0, 1);
		let days = Math.floor((currentDate - startDate) / (24 * 60 * 60 * 1000));
		return Math.ceil(days / 7);
	}

	static getDateByWeek(weekNumber) {

		let dateByWeek = [];
		let yearStart = new Date((new Date()).getFullYear(), 0, 1);
		let dayTime = yearStart.getTime() + (weekNumber * 7 * 24 * 60 * 60 * 1000);
		const date = new Date(dayTime);
		date.setDate(date.getDate() - date.getDay());
		for (let index = 1; index <= 7; index++) {
			dateByWeek = [...dateByWeek, date.setDate(date.getDate() + index)];
			date.setDate(date.getDate() - index);
		}
		return dateByWeek;
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
			tasksByDay[date.getDay() + 1].tasks.push(value);
		})

		return tasksByDay;
	}


}