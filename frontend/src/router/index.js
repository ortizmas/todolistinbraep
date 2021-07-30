import { createWebHistory, createRouter } from 'vue-router';

import TodoComponent from "@/components/Todo/TodoComponent";
import TodoApiComponent from "@/components/Api/TodoApiComponent";


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
	}
];

const router = createRouter({
	history: createWebHistory(),
	routes,
});

export default router;