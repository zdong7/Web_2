const weightWarning = document.querySelector('#weightsNot100');
const assPlate = ` <input type="number" name="weight" id="weight%i" class='weight' min="1" max="100" value=""> <textarea name="desc" id="desc0" class="desc" cols="30" rows="5" maxlength="400" placeholder="None">%d</textarea> <div class="remove"> <button class="btn btn--red remove--btn"> <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg"> <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/> <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/> </svg> </button> </div>`

const createAss = (weight='0', desc='', ind, assId = '') => {
	const newAss = document.createElement('div')
	newAss.innerHTML = assPlate
	newAss.dataset.id = assId
	newAss.querySelector('input').value = weight
	newAss.querySelector('textarea').value = desc
	newAss.querySelector('.remove--btn').id = `trash${ind}`
	newAss.querySelector('.remove--btn').addEventListener('click', removeAss)
	newAss.querySelector('input').id = `weight${ind}`
	newAss.classList.add('inputs')
	newAss.id = `ass${ind}`
	// Change weight ids and so forth
	assessmentStage.appendChild(newAss)
	return newAss
}
const clearAsses = () => {assessmentStage.innerHTML = ''}

const fetchAsses = () => {
	const state = getState();
	console.log('state check', state);
	const url = `assessment.php?major=${state.major}&outcome=${state.outcome}&sectionId=${state.section}`
	fetch(url).then(res => res.json()).then(data => {
		console.log(`Assessments`, data)
		// Check for errors here, which the PHP isn't doing.
		clearAsses();
		data.forEach((ass, ind) => {
			createAss(ass.weight, ass.assessmentDescription, ind, ass.assessmentId)
		})
	})
}

const removeAss = ev => {
	console.log(ev.srcElement.id)
	const ind = ev.srcElement.id.replace(/trash/, '')
	console.log('ind', ind)
	document.querySelector(`#ass${ind}`).classList.add('hidden')
}

const checkWeight = () => {
	let weight = 0;
	const assesRaw = [...assessmentStage.querySelectorAll('.inputs')]
	assesRaw.forEach(elm => {
		if (!elm.classList.contains('hidden'))
			weight += Number(elm.querySelector('input').value)
	})

	if(weight !== 100) {
		weightWarning.classList.remove('hidden')
		return false;
	}
	else {
		weightWarning.classList.add('hidden')
		return true;
	}

}

const saveAsses = () => {
	if(!checkWeight()) return;
	const state = getState();
	const assesRaw = [...assessmentStage.querySelectorAll('.inputs')]
	const asses = assesRaw.map(elm => {
		return {
			weight: elm.querySelector('input').value, 
			desc: elm.querySelector('textarea').value, 
			id: elm.dataset.id || '',
			remove: elm.classList.contains('hidden')
		}
	})
	const updates = asses.map(ass => {
		let url = '';
		if(ass.remove) url = `deleteAssessment.php?assessmentId=${ass.id}`
		else url = `updateAssessment.php?major=${state.major}&outcomeId=${state.outcome}&sectionId=${state.section}&assessmentId=${ass.id}&assessmentDesc=${ass.desc}&weight=${ass.weight}`
		return fetch(url).then(res => res.json())
	})
	
	Promise.all(updates).then(resArray => {
		const overallRes = resArray.reduce((a, b) => a && b)
		reporter('assessments', overallRes)
	})
}

const countAndAddAss = () => {
	const assesN = [...assessmentStage.querySelectorAll('.inputs')].length
	createAss('0', '', assesN)
}

document.querySelector('#newAssessment').addEventListener('click', countAndAddAss)
document.querySelector('#saveAssessments').addEventListener('click', saveAsses)
