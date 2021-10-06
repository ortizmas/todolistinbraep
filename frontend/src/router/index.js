import { createWebHistory, createRouter } from 'vue-router';

import TodoComponent from "@/components/Todo/TodoComponent";
import TodoApiComponent from "@/components/Api/TodoApiComponent";
import ComponentAulaOne from "@/components/Aulas/ComponentAulaOne";
import ComponentAulaTwo from "@/components/Aulas/ComponentAulaTwo";
import ComponentRepeatingForms from "@/components/Aulas/ComponentRepeatingForms";
import TodoItems from '@/components/TodoItem/TodoItem';



const routes = [
	{
		path: "/",
		name: "Todo",
		component: TodoComponent
	},
	{
		path: "/api/todo",
		name: "TodoApi",
		component: TodoApiComponent
	},
	{
		path: "/aula1",
		name: "AulaOne",
		component: ComponentAulaOne
	},
	{
		path: "/aula2",
		name: "AulaTwo",
		component: ComponentAulaTwo
	},
	{
		path: "/repeating-forms",
		name: "RepeatingForm",
		component: ComponentRepeatingForms
	},
	{
		path: "/components",
		name: "TodoItems",
		component: TodoItems
	}
];

const router = createRouter({
	history: createWebHistory(),
	routes,
});

export default router;