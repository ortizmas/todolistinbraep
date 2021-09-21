import { createWebHistory, createRouter } from 'vue-router';

import TodoComponent from "@/components/Todo/TodoComponent";
import TodoApiComponent from "@/components/Api/TodoApiComponent";
import ComponentAulaOne from "@/components/Aula-one/ComponentAulaOne";


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
		path: "/aula-one",
		name: "AulaOne",
		component: ComponentAulaOne
	}
];

const router = createRouter({
	history: createWebHistory(),
	routes,
});

export default router;