const expectScoreElms = [...document.querySelectorAll('.expectations > .filters > input')]
const expectScoreTotalElm = document.querySelector('.totalValue.value')
const outcomeDescStage = document.querySelector('.results > .example > p');
const outcomeMenuStage = document.querySelector('.main-nav');
const sectionStatus = document.querySelector('.sectionLabel');
const sectionStage = document.querySelector('#sectionMenu');
const assessmentStage = document.querySelector('.inputsWrapper');
const userMenu = document.querySelector('.user-menu');

const recountTotal = ev => {
    const scores = expectScoreElms.map(elm => Number(elm.value))
    const total = scores.reduce((sum, val) => sum + val) 
    expectScoreTotalElm.textContent = total
}


const getState = () => {
	const state = {
		major: '',
		section: '', 
		outcome: outcomeMenuStage.querySelector('a.active').dataset.id,
	}
	const sectionOptions = [...sectionStage.querySelectorAll('option')]

	sectionOptions.forEach(elm => {
		if(elm.selected){
				state.major = elm.dataset.major
				state.section = elm.dataset.sectionid
			}
	})

	return state;
}

const reporter = (area, res, msg) => {

	opRes = res === true ? 'fail' : 'success'
	res = res === true ? 'success' : 'fail'
	area += 'Responce'
	const elm = document.querySelector(`.${area}.${res}`)
	const opElm = document.querySelector(`.${area}.${opRes}`)
	const oldMsg = elm.textContent 
	
	elm.classList.remove('hidden')
	opElm.classList.add('hidden')

	/*   BOOOOOOOOO let me do my own thing
	if(msg) elm.textContent = msg;
	setTimeout(() => {
		elm.classList.add('hidden')
		elm.textContent = oldMsg;
	}, 2000)*/
}

expectScoreElms.forEach(input => {
    input.addEventListener('change', recountTotal)
})

document.querySelector('#active-user-menu').addEventListener('click', () => {
	userMenu.classList.toggle('hidden-menu');
})
document.querySelector('#logout').addEventListener('click', () => {
	window.location.assign('login.php?logout=true')
})
