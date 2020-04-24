narStage = document.querySelector('.summary.panel')

const fetchNars = () => {
	const state = getState();
	const url = `narratives.php?major=${state.major}&sectionId=${state.section}&outcome=${state.outcome}`
	//const forms = { 'strengh' }
	fetch(url).then(res => res.json()).then(data => {
		console.log('Narratives', data)
		Object.keys(data[0]||{}).forEach(label => {
			console.log('nar key', label)
			narStage.querySelector(`#${label}`).textContent = data[0][label]
		})
	})

}

const saveNars = () => {
	const state = getState();
	const str = narStage.querySelector('#strengths').value
	const weak = narStage.querySelector('#weaknesses').value
	const act = narStage.querySelector('#actions').value
	console.log(str, weak, act)
	if(!str || !weak) {
		reporter('narratives', false);
		return false;		
	}

	const url = `updateNarrative.php?major=${state.major}&outcomeId=${state.outcome}&sectionId=${state.section}&strengths=${str}&weaknesses=${weak}&actions=${act}`
	console.log(url)
	fetch(url)
		.then(res => res.json())
		.then(stat => reporter('narratives', stat))
}
document.querySelector('#saveNarrative').addEventListener('click', saveNars)
