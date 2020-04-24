const resultsInputStage = document.querySelector('.results .expectations');
const bad = resultsInputStage.querySelector('#notMeetsExpectations');
const ok = resultsInputStage.querySelector('#meetsExpectations');
const good = resultsInputStage.querySelector('#exceedsExpectations');

const clearResults = () => {
		bad.value = 0;
		ok.value = 0;
		good.value = 0;
		recountTotal();
	}

const fetchResults = (major, outcome, section) => {
	const url = `results.php?major=${major}&outcome=${outcome}&sectionId=${section}`
	fetch(url)
		.then(res => res.json())
		.then((data) => {
			console.log('fetching results', major, outcome, section);
			console.log(data);
			const actions = {
				'Not Meets Expectations': (val) => {bad.value = val},
				'Meets Expectations':     (val) => {ok.value = val},
				'Exceeds Expectations':   (val) => {good.value = val}
				}
			Object.values(data).forEach(result => {
				actions[result.description](result.numberOfStudents) 
			})
			recountTotal()
		})
}

const updateResults = (major, outcome, section) => {
	// We'll be making three fetches, each for a different performanceLevel	
	const levels = [1, 2, 3]
	const newVals = {
		1: bad.value,
		2: ok.value, 
		3: good.value,
	}
	console.log(`Updating with ${newVals[1]}, ${newVals[2]}, ${newVals[3]}`)


	const updates = levels.map(level => {
		const url = `updateResults.php?major=${major}&outcomeId=${outcome}&sectionId=${section}&performanceLevel=${level}&numberOfStudents=${newVals[level]}`;
		return fetch(url).then(res => res.json())
	})
	Promise.all(updates).then(resArray => {
		const overallRes = resArray.reduce((a, b) => a && b)
		reporter('results', overallRes)
	})

	
}

document.querySelector('#saveResults').addEventListener('click', () => {
	const state = getState()
	updateResults(state.major, state.outcome, state.section)
})
