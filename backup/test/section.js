console.log('section script running');
//const sectionStatus = document.querySelector('.sectionLabel');
const handleSectionChange = ev => {
	// Find selected option to uncover section id and major 
	[...sectionStage.querySelectorAll('option')].forEach(elm => {
		if(elm.selected){
				clearOutcomes()
				fetchOutcomes(elm.dataset.major, elm.dataset.sectionid)
				sectionStatus.dataset.id = elm.dataset.sectionid
				sectionStatus.textContent = `Section: ${elm.dataset.sectionid}`
			}
	})
}
const sectionChangeEvent = new Event('change');
sectionStage.addEventListener('change', handleSectionChange)
sectionStage.dispatchEvent(sectionChangeEvent);
