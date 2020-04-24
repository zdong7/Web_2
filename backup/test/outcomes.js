
const handleOutcomeClick = ev => {
	const outcomeId = ev.srcElement.dataset.id
	const desc = ev.srcElement.dataset.desc
	const major = ev.srcElement.dataset.major
	const sectionId = sectionStatus.dataset.id
	outcomeMenuStage.querySelectorAll('a').forEach(elm => elm.classList.remove('active'))
	ev.srcElement.classList.add('active');
	outcomeDescStage.innerHTML = `<b>Outcome ${outcomeId} - ${major}: </b> ${desc}`
	fetchResults(major, outcomeId, sectionId);
	fetchAsses();
	fetchNars();
}

const createOutcome = (id, desc, major) => {
	const newElm = document.createElement('a');
	newElm.removeAttribute('href');
	newElm.textContent = `Outcome ${id}`
	newElm.dataset.id = id;
	newElm.dataset.desc = desc;
	newElm.dataset.major = major;
	newElm.addEventListener('click', handleOutcomeClick);
	outcomeMenuStage.appendChild(newElm);
	return newElm;
}

const clearOutcomes = () => {
	const outcomes = outcomeMenuStage.querySelectorAll('a')
	outcomes.forEach(elm => elm.remove())
}
const fetchOutcomes = (major, section) => {
	fetch(`outcomes.php?major=${major}&sectionId=${section}`).then(res => res.json()).then((data) => {
		//data = [... new Set(data)]
		const result = [];
		const map = new Map();
		for (const item of data) {
			if(!map.has(item.outcomeId)){
				map.set(item.outcomeId, true);    // set any value to Map
				result.push({
					id: item.outcomeId,
					desc: item.outcomeDescription,
					major: major
				});
			}
		}
		console.log(result);
		result.map(outcome => createOutcome(...Object.values(outcome)))[0].click();
		
	})
}
console.log('outcome script running');
