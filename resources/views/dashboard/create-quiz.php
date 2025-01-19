<?php
componentsDashboard('header');
componentsDashboard('sidebar');
//Main Content
componentsDashboard('topNavigation');
?>
        <!-- Content -->
        <main class="p-6">
            <div class="min-h-screen bg-gray-100">
                <div class="container">
                    <!-- Header -->
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">My Quizzes</h2>
                        <p class="mt-2 text-gray-600">Fill in the details below to create a new quiz</p>
                    </div>

                    <!-- Main Form -->
                    <form class="space-y-4" id="quizForm" method="Post" onsubmit="createQuiz()">
                        <!-- Quiz Details Section -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Quiz Details</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700">Quiz Title</label>
                                    <input type="text" id="title" name="title" placeholder="Quiz Title" required
                                           class="w-full px-4 py-2 border rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea id="description" name="description" rows="3" placeholder="Description" required
                                              class="w-full px-4 py-2 border rounded-lg mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                                </div>
                                <div>
                                    <label for="timeLimit" class="block text-sm font-medium text-gray-700">Time Limit (minutes)</label>
                                    <input type="number" id="timeLimit" name="timeLimit" placeholder="Time Limit" min="1" required
                                           class="px-4 py-2 border rounded-lg mt-1 block w-48 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- Questions Section -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-semibold text-gray-800">Questions</h2>
                                <button type="button" id="addQuestionBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Add Question
                                </button>
                            </div>

                            <!-- Question Template -->
                            <div id="questionsContainer" class="space-y-6"></div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="px-6 py-3 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                Create Quiz
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
    async function createQuiz(){
        event.preventDefault();
        let form = document.getElementById('quizForm'),
            formData = new FormData(form);
        const { default: apiFetch } = await import('/js/utils/apiFetch.js');
        await apiFetch('/quizzes',{method:'POST',body:formData})
            .then(data => {
                console.log(data)
                window.location.href = '/dashboard';
            })
            .catch((error) => {
                console.error(error.data.errors);
                document.getElementById('error').innerHTML = '';
                Object.keys(error.data.errors).forEach(err => {
                    document.getElementById('error').innerHTML += `<p class="text-red-500 mt-1">${error.data.errors[err]}</p>`;
                })
            });
    }
</script>
</body>
</html>